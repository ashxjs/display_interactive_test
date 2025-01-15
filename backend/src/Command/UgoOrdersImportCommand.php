<?php

namespace App\Command;

use App\Entity\Customer;
use App\Entity\Purchase;
use App\Services\CustomerService;
use App\Services\PurchaseService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;

#[AsCommand(
    name: 'ugo:orders:import',
    description: 'Import customers and purchases from CSV files take the filePath argument as folder path',
)]
class UgoOrdersImportCommand extends Command
{
    private CustomerService $customerService;
    private PurchaseService $purchaseService;
    private LoggerInterface $logger;

    public function __construct(
        CustomerService $customerService,
        PurchaseService $purchaseService,
        LoggerInterface $logger
    ) {
        parent::__construct();
        $this->logger = $logger;
        $this->customerService = $customerService;
        $this->purchaseService = $purchaseService;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('filesPath', InputArgument::REQUIRED, 'Path where CSV files are located');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filesPath = $input->getArgument('filesPath');

        try {
            $this->importCustomers($filesPath);
            $this->importPurchases($filesPath);
        } catch (\Exception $error) {
            $io->error($error->getMessage());
            return Command::FAILURE;
        }

        $io->success('Import succed');

        return Command::SUCCESS;
    }

    public function importCustomers($filePath)
    {
        $this->logger->info('Importing customers ...');
        $customersCSV = $this->findCSVFiles($filePath, 'customers.csv');
        $customers = array_map(fn($customer) => Customer::fromCSV($customer), $customersCSV);
        $this->customerService->bulkInsert($customers);

        $this->logger->info('Import customer succed !!!');
    }

    public function importPurchases($filePath)
    {
        $this->logger->info('Importing purchases ...');
        $purchasesCSV = $this->findCSVFiles($filePath, 'purchases.csv');
        $purchases = array_map(
            function ($purchase) {
                $customer = $this->customerService->findById($purchase[Purchase::CSV_CUSTOMER_ID]);
                return Purchase::fromCSV($purchase, $customer);
            },
            $purchasesCSV
        );

        $this->purchaseService->insertBulk($purchases);
        $this->logger->info('Import purchases succed !!!');
    }

    private function findCSVFiles($filePath, $fileName)
    {
        $finder = new Finder();
        $finder->files()
            ->in($filePath)
            ->name($fileName)
            ->sortByName()
        ;

        foreach ($finder as $file) {
            break;
        }

        return $this->parseCSV($file);
    }

    private function parseCSV($csvFile)
    {
        $rows = array();
        if (($handle = fopen($csvFile->getRealPath(), "r")) !== FALSE) {
            $i = 0;
            while (($data = fgetcsv($handle, null, ";")) !== FALSE) {
                $i++;
                if ($i == 1) {
                    continue;
                }
                $rows[] = $data;
            }
            fclose($handle);
        }

        return $rows;
    }
}
