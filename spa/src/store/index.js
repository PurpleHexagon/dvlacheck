import { configureStore } from '@reduxjs/toolkit';
import vehicleSlice from "./vehicleSlice";
import notificationSlice from "./notificationSlice";

export default configureStore({
    reducer: {
        vehicle: vehicleSlice,
        notification: notificationSlice,
    }
});
