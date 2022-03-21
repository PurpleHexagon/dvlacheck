import { createSlice } from '@reduxjs/toolkit';

export const notificationSlice = createSlice({
  name: "notification",
  initialState: {
    current: { level: '', message: '' }
  },
  reducers: {
    setNotification: (state, action) => {
      state.current = action.payload;
    }
  }
});

export const { setNotification } = notificationSlice.actions;
export const showNotification = (state) => state.notification.current;

export default notificationSlice.reducer;
