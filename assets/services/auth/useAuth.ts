import { useUser } from "./useUser";
import api from "../ApiService";

export const useAuth = () => {
    const { getUser, setUser, removeUser, updateUser} = useUser();

    const login = async (username: string, password: string) => {
        const {token, refreshToken} = await api.login(username, password);
        setUser({username: username, token: token, refreshToken: refreshToken});
    };

    const refreshToken = async (): Promise<string> => {
        const {token, refreshToken} = await api.refreshToken(getUser().refreshToken);
        updateUser({token: token, refreshToken: refreshToken});

        return token;
    }

    const logout = async () => {
        removeUser();
    };

    const isLoggedIn = (): boolean => {
        return getUser() !== null;
    }

    return { getUser, login, logout, isLoggedIn, refreshToken};
};
