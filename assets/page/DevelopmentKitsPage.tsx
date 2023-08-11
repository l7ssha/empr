import { Paper } from "@mui/material";
import {
  GridColDef,
  GridToolbarContainer,
  GridToolbarExport,
} from "@mui/x-data-grid";
import { SimpleDataGrid } from "../component/SimpleDataGrid";
import apiService from "../services/ApiService";
import { mapDevelopmentType } from "../services/ReadableStringMapper";
import { BasePage } from "./BasePage";

function GridToolbar() {
  return (
    <GridToolbarContainer>
      <GridToolbarExport />
    </GridToolbarContainer>
  );
}

export const DevelopmentKitsPage = () => {
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
        <SimpleDataGrid
          columns={columns}
          callback={(pagination, sortModel) =>
            apiService.getAllDevelopmentKits(pagination, sortModel)
          }
        />
      </Paper>
    </BasePage>
  );
};
