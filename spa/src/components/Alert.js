import Snackbar from "@mui/material/Snackbar";
import * as React from "react";
import MuiAlert from "@mui/material/Alert";
import {Box} from "@mui/material";
import { showNotification, setNotification } from "./../store/notificationSlice";
import { useDispatch, useSelector } from "react-redux";
import { useEffect } from 'react';
import { isEmpty } from "ramda";

const Alert = React.forwardRef(function Alert(props, ref) {
  return <MuiAlert elevation={6} ref={ref} variant="filled" {...props} />;
});

const VehicleAlert = () => {
  const dispatch = useDispatch();
  const notification = useSelector(showNotification);
  const [open, setOpen] = React.useState(false);

  useEffect(() => {
    if (isEmpty(notification.message) === false) {
      setOpen(true);
    }
  }, [setOpen, notification]);

  const handleClose = (event, reason) => {
    if (reason === 'clickaway') {
      return;
    }
    setOpen(false);
    dispatch(setNotification({ message: '', level: '' }));
  };

  return (
    <Box>
      {
        isEmpty(notification.message) === false &&
        <Snackbar open={open} autoHideDuration={5000} onClose={handleClose}>
          <Alert onClose={handleClose} severity={notification.level} sx={{ width: '100%' }}>
            { notification.message }
          </Alert>
        </Snackbar>
      }
    </Box>
  );
};

export default VehicleAlert;