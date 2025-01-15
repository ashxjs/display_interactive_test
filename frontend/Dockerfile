# Build stage
FROM node:lts-alpine3.20 as build
WORKDIR /app
COPY . .

# Add build-time ARG that can be passed during docker build
ARG BASE_URL
ENV VITE_BASE_URL=${BASE_URL}

RUN yarn install
RUN yarn build

# Production stage
FROM nginx:alpine
COPY --from=build /app/dist /usr/share/nginx/html
COPY nginx.conf /etc/nginx/conf.d/default.conf
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]