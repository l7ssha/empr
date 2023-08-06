import { Paper, TableContainer } from "@mui/material";
import { BasePage } from "./BasePage";
import apiService from "../services/ApiService";
import {
  DataGrid,
  GridColDef,
  GridToolbarContainer,
  GridToolbarExport,
} from "@mui/x-data-grid";
import { usePagination } from "../services/usePagination";

function GridToolbar() {
  return (
    <GridToolbarContainer>
      <GridToolbarExport />
    </GridToolbarContainer>
  );
}

export const DevelopmentKitsPage = () => {
  const { result, totalRowCount, paginationModel, setPaginationModel } =
    usePagination((pagination) => apiService.getAllDevelopmentKits(pagination));

  const columns: GridColDef[] = [
    { field: "name", headerName: "Name", width: 250 },
    { field: "type", headerName: "Type", width: 150 },
    { field: "developmentsCount", headerName: "Development Count", width: 150 },
  ];

  return (
    <BasePage>
      <Paper
        elevation={0}
        variant="outlined"
        square
        sx={{ marginTop: "10px", padding: "5px" }}
      >
        <TableContainer component={Paper}>
          <DataGrid
            columns={columns}
            rows={result}
            slots={{ toolbar: GridToolbar }}
            paginationModel={paginationModel}
            onPaginationModelChange={setPaginationModel}
            rowCount={totalRowCount}
            paginationMode="server"
            pageSizeOptions={[5, 10, 25]}
          />
        </TableContainer>
      </Paper>
    </BasePage>
  );
};
