import { GridSortModel } from "@mui/x-data-grid";
import { GridCallbackDetails } from "@mui/x-data-grid/models/api";
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
  handleSortModeChange: SetHandleSortModelChange;
}

export interface PaginationModel {
  pageSize: number;
  page: number;
}

export type GetResultCallback<T> = (
  pagination: PaginationModel,
  sortModel: GridSortModel | null,
) => Promise<PaginatedResponse<T>>;

export type SetHandleSortModelChange = (sortModel: GridSortModel) => void;

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
    useState<PaginationModel>({ page: -1, pageSize: -1 });
  const [previousSortModel, setPreviousSortModel] =
    useState<GridSortModel | null>(null);

  const performDataQuery = () => {
    callback(paginationModel, sortModel).then((result) => {
      setTotalRowCount(result.total);
      setResult(result.results);
      setPreviousPaginationModel(paginationModel);
      setPreviousSortModel(sortModel);
    });
  };

  useMemo(() => {
    // TODO: These two ifs are hacks. Dont know how to fix those
    if (sortModel == previousSortModel) {
      return;
    }

    console.log("previousSortModel changed");
    performDataQuery();
  }, [sortModel]);

  useMemo(() => {
    // TODO: These two ifs are hacks. Dont know how to fix those
    if (
      previousPaginationModel.page === paginationModel.page &&
      previousPaginationModel.pageSize === paginationModel.pageSize
    ) {
      return;
    }

    performDataQuery();
  }, [paginationModel.page, paginationModel.pageSize]);

  return {
    result: result,
    totalRowCount: totalRowCount,
    paginationModel: paginationModel,
    setPaginationModel: setPaginationModel,
    handleSortModeChange: (sortModel) => setSortModel(sortModel),
  };
}
