import {Box, Button, Container, Grid, TextField} from "@mui/material";
import * as React from "react";
import { getVehicleAsync } from "../store/vehicleSlice";
import { useDispatch } from "react-redux";
import { useState } from "react";

const VehicleSearch = () => {
  const dispatch = useDispatch();

  const [state, setState] = useState({ registration: '' });

  const handleChange = (event) => {
    setState({
      ...state,
      registration: event.target.value,
    });
  };

  const searchButtonHandler = () => {
    if (state.registration) {
      dispatch(getVehicleAsync({ registration: state.registration }))
    }
  }

  return (
    <Container fixed>
      <Box sx={{ width: 300, margin: '2rem auto' }}>
        <Grid container>
          <Grid item>
            <TextField id="outlined-basic"
                       label="Vehicle Registration"
                       variant="outlined"
                       value={state.registration}
                       onChange={handleChange}/>
          </Grid>

          <Grid item
                alignItems="stretch"
                style={{ display: "flex" }}>
            <Button variant="contained"
                    sx={{ borderRadius: '0 10px 10px 0' }}
                    onClick={searchButtonHandler}>
              Search
            </Button>
          </Grid>
        </Grid>
      </Box>
    </Container>
  );
};

export default VehicleSearch;