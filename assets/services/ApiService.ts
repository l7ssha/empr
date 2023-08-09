import { GridSortModel } from "@mui/x-data-grid";
import { AxiosError, AxiosResponse, Method } from "axios";
import { useUser } from "./auth/useUser";
import axios from "./axios";
import { PaginationModel } from "./usePaginatedDataQuery";

export interface LoginResponse {
  token: string;
  refreshToken: string;
}

export type FilmType = "bw" | "color_negative" | "color_positive";
export type DevelopmentType =
  | "bw_negative"
  | "bw_positive"
  | "bw_one_shot"
  | "color_negative_3step"
  | "color_negative_2step"
  | "color_positive_3step"
  | "color_positive_6step";

export interface FilmResponse {
  id: string;
  name: string;
  type: FilmType;
  speed: number;
}

export interface DevelopmentKitResponse {
  id: string;
  name: string;
  type: DevelopmentType;
  developmentsCount: number;
  times: object; // TODO: Make proper dto
}

export interface PaginatedResponse<T> {
  page: number;
  itemsPerPage: number;
  totalPages: number;
  total: number;
  results: Array<T>;
}

interface ExecuteSafePaginatedParameters<S> {
  url: string;
  data?: S | null;
  method?: Method;
  useAuth?: boolean;
  page?: number;
  perPage?: number;
  sort?: GridSortModel;
}

export class ApiService {
  public async login(username: string, password: string) {
    const { data } = await this.executeSafe<LoginResponse>(
      "/api/auth/login",
      {
        login: username,
        password: password,
      },
      "POST",
      false,
    );

    return data;
  }

  public async refreshToken(refreshToken: string) {
    const { data } = await this.executeSafe<LoginResponse>(
      "/api/auth/refresh",
      {
        refreshToken: refreshToken,
      },
      "POST",
      false,
    );

    return data;
  }

  public async getAllFilms(
    pagination: PaginationModel,
    sortModel: GridSortModel | null,
  ): Promise<PaginatedResponse<FilmResponse>> {
    const { data } = await this.executeSafePaginated<FilmResponse>({
      url: "/api/films",
      page: pagination.page,
      perPage: pagination.pageSize,
      sort: sortModel,
    });

    return data;
  }

  public async getAllDevelopmentKits(
    pagination: PaginationModel,
    sortModel: GridSortModel | null,
  ): Promise<PaginatedResponse<DevelopmentKitResponse>> {
    const { data } = await this.executeSafePaginated<DevelopmentKitResponse>({
      url: "/api/development_kits",
      page: pagination.page,
      perPage: pagination.pageSize,
      sort: sortModel,
    });

    return data;
  }

  private async executeSafePaginated<T, S = any>({
    url,
    data = null,
    method = "GET",
    useAuth = true,
    page = 0,
    perPage = 30,
    sort = null,
  }: ExecuteSafePaginatedParameters<S>): Promise<
    AxiosResponse<PaginatedResponse<T>>
  > {
    return this.executeSafe<PaginatedResponse<T>, S>(
      url,
      data,
      method,
      useAuth,
      {
        page: page + 1,
        perPage: perPage,
        ...this.makeSortQueryFromGridSortModel(sort),
      },
    );
  }

  private async executeSafe<T, S = any>(
    url: string,
    data: S | null = null,
    method: Method = "GET",
    useAuth: boolean = true,
    query: any = null,
  ): Promise<AxiosResponse<T>> {
    const { getUser } = useUser();
    const user = getUser();

    const headers = {};
    if (user !== null && useAuth) {
      headers["Authorization"] = "Bearer " + user.token;
    }

    try {
      return await axios.request<T>({
        url: url,
        data: data,
        method: method,
        headers: headers,
        params: query,
      });
    } catch (e) {
      if (e instanceof AxiosError) {
        throw new Error(`ApiService error: '${e.message}'; Code: '${e.code}'`);
      }

      throw new e();
    }
  }

  private makeSortQueryFromGridSortModel(sortModel: GridSortModel | null): any {
    if (sortModel === null) {
      return {};
    }

    const query = {};
    for (const gridSortItem of sortModel) {
      query[`order[${gridSortItem.field}]`] = gridSortItem.sort;
    }

    return query;
  }
}

export default new ApiService();
