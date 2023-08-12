import { GridSortModel } from "@mui/x-data-grid";
import { GridCallbackDetails } from "@mui/x-data-grid/models/api";
import { GridFilterModel } from "@mui/x-data-grid/models/gridFilterModel";
import { GridPaginationModel } from "@mui/x-data-grid/models/gridPaginationProps";
import { useMemo, useState } from "react";
import { PaginatedResponse } from "./ApiService";

export interface usePaginationInterface<T> {
  result: T[];
  totalRowCount: number;
  paginationModel: PaginationModel;
  setPaginationModel: (
    model: GridPaginationModel,
    details: GridCallbackDetails,
  ) => void;
  handleFilterChange: SetHandleFilterChange;
  handleSortModeChange: SetHandleSortModelChange;
}

export interface PaginationModel {
  pageSize: number;
  page: number;
}

export type GetResultCallback<T> = (
  pagination: PaginationModel,
  sortModel: GridSortModel | null,
  filterModel: GridFilterModel | null,
) => Promise<PaginatedResponse<T>>;

export type SetHandleSortModelChange = (sortModel: GridSortModel) => void;
export type SetHandleFilterChange = (filterModel: GridFilterModel) => void;

export function usePaginatedDataQuery<T>(
  callback: GetResultCallback<T>,
): usePaginationInterface<T> {
  const [result, setResult] = useState<T[]>([]);
  const [totalRowCount, setTotalRowCount] = useState(0);
  const [paginationModel, setPaginationModel] = useState<PaginationModel>({
    pageSize: 5,
    page: 0,
  });
  const [sortModel, setSortModel] = useState<GridSortModel | null>(null);
  const [previousPaginationModel, setPreviousPaginationModel] =
    useState<PaginationModel | null>(null);
  const [previousSortModel, setPreviousSortModel] =
    useState<GridSortModel | null>(null);
  const [filterModel, setFilterModel] = useState<GridFilterModel | null>(null);
  const [previousFilterModel, setPreviousFilterModel] =
    useState<GridFilterModel | null>(null);

  const performDataQuery = () => {
    callback(paginationModel, sortModel, filterModel).then((result) => {
      setTotalRowCount(result.total);
      setResult(result.results);
      setPreviousPaginationModel(paginationModel);
      setPreviousSortModel(sortModel);
      setPreviousFilterModel(filterModel);
    });
  };

  useMemo(() => {
    // TODO: These two ifs are hacks. Dont know how to fix those
    if (filterModel == previousFilterModel) {
      return;
    }

    performDataQuery();
  }, [filterModel]);

  useMemo(() => {
    // TODO: These two ifs are hacks. Dont know how to fix those
    if (sortModel == previousSortModel) {
      return;
    }

    performDataQuery();
  }, [sortModel]);

  useMemo(() => {
    // TODO: These two ifs are hacks. Dont know how to fix those
    if (paginationModel == previousPaginationModel) {
      return;
    }

    performDataQuery();
  }, [paginationModel]);

  return {
    result: result,
    totalRowCount: totalRowCount,
    paginationModel: paginationModel,
    setPaginationModel: setPaginationModel,
    handleSortModeChange: (sortModel) => setSortModel(sortModel),
    handleFilterChange: (filterModel) => setFilterModel(filterModel),
  };
}
