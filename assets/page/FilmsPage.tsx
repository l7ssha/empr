import {
  Paper,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
} from "@mui/material";
import { BasePage } from "./BasePage";
import apiService, { FilmResponse } from "../services/ApiService";
import { useEffect, useState } from "react";
import { mapFilmType } from "../services/ReadableStringMapper";
import { usePaginatedDataQuery } from "../services/usePaginatedDataQuery";
import { DataGrid, GridColDef, GridToolbar } from "@mui/x-data-grid";

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
    { field: "name", headerName: "Name", width: 250 },
    { field: "type", headerName: "Type", width: 150 },
    { field: "speed", headerName: "Speed (ISO/ASA)", width: 150 },
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
