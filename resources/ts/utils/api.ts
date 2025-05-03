// import { ofetch } from 'ofetch'

// export const $api = ofetch.create({
//   baseURL: import.meta.env.VITE_API_BASE_URL || '/api',
//   async onRequest({ options }) {
//     const accessToken = useCookie('accessToken').value
//     if (accessToken)
//       options.headers.append('Authorization', `Bearer ${accessToken}`)
//   },
// })

import axios from 'axios';

export const $api = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL || '/api',
});

$api.interceptors.request.use(config => {
  const accessToken = useCookie('accessToken').value;
  if (accessToken) {
    config.headers['Authorization'] = `Bearer ${accessToken}`;
  }
  return config;
}) 
