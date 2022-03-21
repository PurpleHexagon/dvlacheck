import * as React from 'react';
import styled from '@emotion/styled';
import { Grid, Box, Typography, CardContent, Card, Container, CardHeader } from '@mui/material';

import { useSelector } from "react-redux";
import { showVehicle, showLastSearchedRegistration } from "./store/vehicleSlice";

import VehicleDetails from "./components/VehicleDetails";
import Header from "./components/Header";
import VehicleSearch from "./components/VehicleSearch";
import Alert from "./components/Alert";

function App() {
  const vehicle = useSelector(showVehicle);
  const registration = useSelector(showLastSearchedRegistration);

  const AppContainer = styled.div({ textAlign: 'center' })

  return (
    <AppContainer>
      <Alert/>
      <Header/>
      <Box sx={{ flexGrow: 1, m: 5 }}>
        <Container fixed>
          <Grid rowSpacing={2}>
            <Card sx={{ minWidth: 275 }}>
              <CardContent>
                <CardHeader title={'Welcome to Vehicle Checker Online'}/>
                <Typography sx={{ fontSize: 14 }} color="text.secondary" gutterBottom>
                  Want to find out more information about a car? Then you've come to the right place.
                  We want to revolutionise the way you find out about MOTs. Making the world a better place through high speed vehicle lookups.
                </Typography>

                <VehicleSearch/>
              </CardContent>
            </Card>
          </Grid>
        </Container>
      </Box>
      <VehicleDetails vehicle={vehicle} registration={registration}></VehicleDetails>
    </AppContainer>
  );
}

export default App;
