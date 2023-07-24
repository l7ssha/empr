import { useLocalStorage } from "../useLocalStorage";

// NOTE: optimally move this into a separate file
export interface User {
    username: string;
    token: string;
    refreshToken: string;
}

export const useUser = () => {
    const { setItem, getItem } = useLocalStorage();

    const setUser = (user: User) => {
        setItem("user", JSON.stringify(user));
    };

    const removeUser = () => {
        setItem("user", "");
    };

    const getUser = (): User|null => {
        const userData = getItem("user");
        if (userData === null) {
            return null;
        }

        return JSON.parse(getItem("user"));
    }

    return { getUser, setUser, removeUser };
};
