import axios from './axios';
import {AxiosError, AxiosResponse} from "axios";

export interface LoginResponse {
    token: string,
    refreshToken: string,
}

export class ApiService {
    public async login(username: string, password: string) {
        const {data} = await this.executeSafe<LoginResponse>(
            "/api/auth/login",
            {
                login: username,
                password: password
            }
        );

        return data;
    }

    private async executeSafe<T, S = any>(url: string, data: S): Promise<AxiosResponse<T>> {
        try {
            return await axios.post<T>(
                url,
                data,
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
