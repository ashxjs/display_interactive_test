const API_URL = "http://localhost";

class CustomerService {
  public async getAll() {
    const url = `${API_URL}/customers`;
    try {
      const res = await fetch(url);

      return res.json();
    } catch (err) {
      console.error(
        "[CUSTOMER] - fail to fetch customer =>",
        (err as Error).message
      );
    }
  }
}

export const customerService = new CustomerService();
