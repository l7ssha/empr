import { useMemo, useState } from "react";
import { PaginatedResponse } from "./ApiService";
import { GridPaginationModel } from "@mui/x-data-grid/models/gridPaginationProps";
import { GridCallbackDetails } from "@mui/x-data-grid/models/api";

export interface usePaginationInterface<T> {
  result: T[];
  totalRowCount: number;
  paginationModel: PaginationModel;
  setPaginationModel: (
    model: GridPaginationModel,
    details: GridCallbackDetails,
  ) => void;
}

export interface PaginationModel {
  pageSize: number;
  page: number;
}

export type GetResultCallback<T> = (
  pagination: PaginationModel,
) => Promise<PaginatedResponse<T>>;

export function usePagination<T>(
  callback: GetResultCallback<T>,
): usePaginationInterface<T> {
  const [result, setResult] = useState<T[]>([]);
  const [totalRowCount, setTotalRowCount] = useState(0);
  const [paginationModel, setPaginationModel] = useState<PaginationModel>({
    pageSize: 5,
    page: 1,
  });
  const [previousPaginationModel, setPreviousPaginationModel] =
    useState<PaginationModel>({ page: -1, pageSize: -1 });

  useMemo(() => {
    // TODO: These two ifs are hacks. Dont know how to fix those
    if (paginationModel.page === 0) {
      paginationModel.page = 1;
    }

    if (
      previousPaginationModel.page === paginationModel.page &&
      previousPaginationModel.pageSize === paginationModel.pageSize
    ) {
      return;
    }

    callback(paginationModel).then((result) => {
      setTotalRowCount(result.total);
      setResult(result.results);
      setPreviousPaginationModel(paginationModel);
    });
  }, [paginationModel.page, paginationModel.pageSize]);

  return {
    result: result,
    totalRowCount: totalRowCount,
    paginationModel: paginationModel,
    setPaginationModel: setPaginationModel,
  };
}
