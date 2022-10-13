import axios from 'axios';

const axiosConfig = axios.create({
  headers: {
    'Content-type': 'application/json',
    HTTP_X_REQUESTED_WITH: 'XMLHttpRequest',
  },
  baseURL: 'http://localhost:3000',
});

export default axiosConfig;