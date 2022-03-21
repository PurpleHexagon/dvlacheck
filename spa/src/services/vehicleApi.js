import axios from "axios";
import config from "./../config";
import { setNotification } from '../store/notificationSlice';

const vehicleApi = ({ registration, dispatch }) => {
  return axios.get(config.vehicleApiUrl + registration)
    .then((result) => {
      dispatch(setNotification({ level: 'success', message: 'Registration Found' }));

      return result.data;
    })
    .catch((error) => {
      if (error.response.status === 404) {
        dispatch(setNotification({ level: 'error', message: 'Registration Not Found' }));

        return {};
      }

      dispatch(setNotification({ level: 'error', message: 'Unknown Error' }));

      return {};
    });
};

export default vehicleApi;