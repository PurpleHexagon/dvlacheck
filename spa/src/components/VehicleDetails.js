import {isEmpty} from "ramda";
import Box from "@mui/material/Box";
import Container from "@mui/material/Container";
import TableContainer from "@mui/material/TableContainer";
import Paper from "@mui/material/Paper";
import Table from "@mui/material/Table";
import TableBody from "@mui/material/TableBody";
import TableRow from "@mui/material/TableRow";
import TableCell from "@mui/material/TableCell";
import { Typography } from "@mui/material";
import * as React from "react";

const VehicleDetails = ({ vehicle, registration }) => {
  return (
    <Box>
      {isEmpty(vehicle) === false &&
        <Box>
          {
            registration &&
              <Typography variant="h5" component="h2">
                Results for registration: {registration}
              </Typography>
          }
          <Container fixed sx={{ mt: 4, mb: 4 }}>
            <TableContainer component={Paper}>
              <Table sx={{ minWidth: 400 }} aria-label="simple table">
                <TableBody>
                  <TableRow key={'make'}>
                    <TableCell align="right">{'Make'}</TableCell>
                    <TableCell align="right">{vehicle.make}</TableCell>
                  </TableRow>

                  <TableRow key={'model'}>
                    <TableCell align="right">{'Model'}</TableCell>
                    <TableCell align="right">{vehicle.model}</TableCell>
                  </TableRow>

                  <TableRow key={'colour'}
                            sx={{ '&:last-child td, &:last-child th': { border: 0 } }}>
                    <TableCell align="right">{'Colour'}</TableCell>
                    <TableCell align="right">{vehicle.colour}</TableCell>
                  </TableRow>

                  <TableRow key={'mot_expiry_date'}
                            sx={{ '&:last-child td, &:last-child th': { border: 0 } }}>
                    <TableCell align="right">{'MOT Expiry Date'}</TableCell>
                    <TableCell align="right">{vehicle.mot_expiry_date || 'No MOT Expiry'}</TableCell>
                  </TableRow>

                  <TableRow key={'failed_mot_count'}
                            sx={{ '&:last-child td, &:last-child th': { border: 0 } }}>
                    <TableCell align="right">{'Failed'}</TableCell>
                    <TableCell align="right">{vehicle.failed_mot_count}</TableCell>
                  </TableRow>
                </TableBody>
              </Table>
            </TableContainer>
          </Container>
        </Box>
      }
    </Box>
  );
};

export default VehicleDetails;
