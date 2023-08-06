import { useEffect, useState } from "react";
import { PaginatedResponse } from "./ApiService";

export interface usePaginationInterface<T> {
  result: T[];
  totalRowCount: number;
  paginationModel: PaginationModel;
  setPaginationModel: any;
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
    pageSize: 25,
    page: 1,
  });

  useEffect(() => {
    if (paginationModel.page === 0) {
      return;
    }

    callback(paginationModel).then((result) => {
      setTotalRowCount(result.total);
      setResult(result.results);
    });
  }, [paginationModel.page, paginationModel.pageSize]);

  return {
    result: result,
    totalRowCount: totalRowCount,
    paginationModel: paginationModel,
    setPaginationModel: setPaginationModel,
  };
}
