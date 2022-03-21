import { createSlice } from '@reduxjs/toolkit';
import vehicleApi from './../services/vehicleApi';

export const vehicleSlice = createSlice({
  name: "vehicle",
  initialState: {
    details: {},
    lastSearchedRegistration: '',
  },
  reducers: {
    setVehicle: (state, action) => {
      state.details = action.payload;
    },
    setLastSearchedRegistration: (state, action) => {
      state.lastSearchedRegistration = action.payload;
    }
  }
});

export const getVehicleAsync = (payload) => async (dispatch) => {
  const response = await vehicleApi({ dispatch, ...payload });
  dispatch(setVehicle(response));
  dispatch(setLastSearchedRegistration(payload.registration));
};

export const { setVehicle, setLastSearchedRegistration } = vehicleSlice.actions;
export const showVehicle = (state) => state.vehicle.details;
export const showLastSearchedRegistration = (state) => state.vehicle.lastSearchedRegistration;

export default vehicleSlice.reducer;
