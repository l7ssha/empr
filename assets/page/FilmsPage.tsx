import { Button, Paper } from "@mui/material";
import { GridColDef } from "@mui/x-data-grid";
import { SimpleDataGrid } from "../component/SimpleDataGrid";
import apiService from "../services/ApiService";
import { mapFilmType } from "../services/ReadableStringMapper";
import { BasePage } from "./BasePage";

export const FilmsPage = () => {
  const columns: GridColDef[] = [
    { field: "name", headerName: "Name", width: 350 },
    {
      field: "type",
      headerName: "Type",
      width: 150,
      filterable: false,
      valueFormatter: (params) => mapFilmType(params.value),
    },
    {
      field: "speed",
      headerName: "Speed (ISO/ASA)",
      width: 150,
      filterable: false,
    },
    {
      field: "actions",
      headerName: "Actions",
      filterable: false,
      hideable: false,
      sortable: false,
      disableColumnMenu: true,
      headerAlign: "right",
      align: "right",
      renderCell: (params) => (
        <Button onClick={() => console.log(params)}>Edit</Button>
      ),
    },
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
          callback={(pagination, sortModel, filterModel) =>
            apiService.getAllFilms(pagination, sortModel, filterModel)
          }
        />
      </Paper>
    </BasePage>
  );
};
