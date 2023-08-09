import { Button, Paper, TableContainer } from "@mui/material";
import { DataGrid, GridColDef } from "@mui/x-data-grid";
import apiService, { FilmResponse } from "../services/ApiService";
import { mapFilmType } from "../services/ReadableStringMapper";
import { usePaginatedDataQuery } from "../services/usePaginatedDataQuery";
import { BasePage } from "./BasePage";

export const FilmsPage = () => {
  const {
    result,
    totalRowCount,
    paginationModel,
    setPaginationModel,
    handleSortModeChange,
  } = usePaginatedDataQuery<FilmResponse>((pagination, sortModel) =>
    apiService.getAllFilms(pagination, sortModel),
  );

  const columns: GridColDef[] = [
    { field: "name", headerName: "Name", width: 350 },
    {
      field: "type",
      headerName: "Type",
      width: 150,
      valueFormatter: (params) => mapFilmType(params.value),
    },
    { field: "speed", headerName: "Speed (ISO/ASA)", width: 150 },
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
        <TableContainer component={Paper}>
          <DataGrid
            columns={columns}
            rows={result}
            paginationModel={paginationModel}
            onPaginationModelChange={setPaginationModel}
            rowCount={totalRowCount}
            paginationMode="server"
            pageSizeOptions={[5, 10, 25]}
            sortingMode="server"
            onSortModelChange={handleSortModeChange}
          />
        </TableContainer>
      </Paper>
    </BasePage>
  );
};
