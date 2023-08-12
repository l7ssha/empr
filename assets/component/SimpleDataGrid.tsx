import { Paper, TableContainer } from "@mui/material";
import { DataGrid, GridColDef } from "@mui/x-data-grid";
import {
  GetResultCallback,
  usePaginatedDataQuery,
} from "../services/usePaginatedDataQuery";

export interface SimpleDataGridProps<T> {
  callback: GetResultCallback<T>;
  columns: GridColDef[];
}

export function SimpleDataGrid<T>({
  callback,
  columns,
}: SimpleDataGridProps<T>) {
  const {
    result,
    totalRowCount,
    paginationModel,
    setPaginationModel,
    handleSortModeChange,
    handleFilterChange,
  } = usePaginatedDataQuery(callback);

  return (
    <TableContainer component={Paper}>
      <DataGrid
        columns={columns}
        rows={result}
        rowCount={totalRowCount}
        paginationModel={paginationModel}
        onPaginationModelChange={setPaginationModel}
        paginationMode="server"
        pageSizeOptions={[5, 10, 25]}
        onSortModelChange={handleSortModeChange}
        sortingMode="server"
        filterMode="server"
        onFilterModelChange={handleFilterChange}
      />
    </TableContainer>
  );
}
