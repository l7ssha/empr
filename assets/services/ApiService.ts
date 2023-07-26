import axios from './axios';
import {AxiosError, AxiosResponse} from "axios";
import {Method} from "axios";
import {useUser} from "./auth/useUser";

export interface LoginResponse {
    token: string,
    refreshToken: string,
}

export type FilmType = 'bw' | 'color_negative' | 'color_positive';

export interface FilmResponse {
    id: string,
    name: string,
    type: FilmType,
    speed: number,
}

export class ApiService {
    public async login(username: string, password: string) {
        const {data} = await this.executeSafe<LoginResponse>(
            "/api/auth/login",
            {
                login: username,
                password: password
            },
            'POST',
            false,
        );

        return data;
    }

    public async refreshToken(refreshToken: string) {
        const {data} = await this.executeSafe<LoginResponse>(
            "/api/auth/refresh",
            {
                refreshToken: refreshToken,
            },
            'POST',
            false,
        );

        return data;
    }

    public async getAllFilms() {
        const {data} = await this.executeSafe<FilmResponse[]>(
            "/api/films",
        )

        return data;
    }

    private async executeSafe<T, S = any>(url: string, data: S|null = null, method: Method = 'GET', useAuth: boolean = true): Promise<AxiosResponse<T>> {
        const {getUser} = useUser();
        const user = getUser();

        const headers = {};
        if (user !== null && useAuth) {
            headers['Authorization'] = "Bearer " + user.token;
        }

        try {
            return await axios.request<T>(
                {
                    url: url,
                    data: data,
                    method: method,
                    headers: headers,
                }
            )
        } catch (e) {
            if (e instanceof AxiosError) {
                throw new Error(`ApiService error: '${e.message}'; Code: '${e.code}'`);
            }

            throw new e;
        }
    }
}

export default new ApiService();
