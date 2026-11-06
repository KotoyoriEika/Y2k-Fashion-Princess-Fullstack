const BASE = "http://127.0.0.1:8000/api";

export const getProducts = () =>
  fetch(`${BASE}/products`).then((r) => r.json()).then((r) => r.data);

export const getProduct = (id) =>
  fetch(`${BASE}/products/${id}`).then((r) => r.json()).then((r) => r.data);

export const login = (email, password) =>
  fetch(`${BASE}/login`, {
    method: "POST",
    headers: { "Content-Type": "application/json", Accept: "application/json" },
    body: JSON.stringify({ email, password }),
  }).then((r) => r.json());