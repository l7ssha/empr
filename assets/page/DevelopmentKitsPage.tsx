import { Paper, TableContainer } from "@mui/material";
import {
  DataGrid,
  GridColDef,
  GridToolbarContainer,
  GridToolbarExport,
} from "@mui/x-data-grid";
import apiService from "../services/ApiService";
import { mapDevelopmentType } from "../services/ReadableStringMapper";
import { usePaginatedDataQuery } from "../services/usePaginatedDataQuery";
import { BasePage } from "./BasePage";

function GridToolbar() {
  return (
    <GridToolbarContainer>
      <GridToolbarExport />
    </GridToolbarContainer>
  );
}

export const DevelopmentKitsPage = () => {
  const {
    result,
    totalRowCount,
    paginationModel,
    setPaginationModel,
    handleSortModeChange,
  } = usePaginatedDataQuery((pagination, sortModel) =>
    apiService.getAllDevelopmentKits(pagination, sortModel),
  );

  const columns: GridColDef[] = [
    { field: "name", headerName: "Name", width: 250 },
    {
      field: "type",
      headerName: "Type",
      width: 250,
      valueFormatter: (params) => mapDevelopmentType(params.value),
    },
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
            sortingMode="server"
            pageSizeOptions={[5, 10, 25]}
            onSortModelChange={handleSortModeChange}
          />
        </TableContainer>
      </Paper>
    </BasePage>
  );
};
