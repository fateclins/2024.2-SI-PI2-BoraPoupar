import axios from 'axios';

const api = axios.create({
  baseURL: 'http://10.0.2.2/api/v1/',
  headers: {
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest',
  },
  withCredentials: true,
});

export default api;