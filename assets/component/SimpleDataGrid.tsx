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
  } = usePaginatedDataQuery((pagination, sortModel) =>
    callback(pagination, sortModel),
  );

  return (
    <TableContainer component={Paper}>
      <DataGrid
        columns={columns}
        rows={result}
        paginationModel={paginationModel}
        onPaginationModelChange={setPaginationModel}
        rowCount={totalRowCount}
        paginationMode="server"
        sortingMode="server"
        pageSizeOptions={[5, 10, 25]}
        onSortModelChange={handleSortModeChange}
      />
    </TableContainer>
  );
}
