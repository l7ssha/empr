import axios from "./axios";
import { AxiosError, AxiosResponse } from "axios";
import { Method } from "axios";
import { useUser } from "./auth/useUser";
import { PaginationModel } from "./usePagination";

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

  public async getAllFilms() {
    const { data } = await this.executeSafe<FilmResponse[]>("/api/films");

    return data;
  }

  public async getAllDevelopmentKits(
    pagination: PaginationModel,
  ): Promise<PaginatedResponse<DevelopmentKitResponse>> {
    const { data } = await this.executeSafePaginated<DevelopmentKitResponse>({
      url: "/api/development_kits",
      page: pagination.page,
      perPage: pagination.pageSize,
    });

    return data;
  }

  private async executeSafePaginated<T, S = any>({
    url,
    data = null,
    method = "GET",
    useAuth = true,
    page = 1,
    perPage = 30,
  }: ExecuteSafePaginatedParameters<S>): Promise<
    AxiosResponse<PaginatedResponse<T>>
  > {
    return this.executeSafe<PaginatedResponse<T>, S>(
      url,
      data,
      method,
      useAuth,
      {
        page: page,
        perPage: perPage,
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
}

export default new ApiService();
