import {Navigate, Outlet, Route, Routes} from "react-router-dom";
import {useAuth} from "../../services/auth/useAuth";

export const ProtectedRoute = ({children}) => {
    let { isLoggedIn }  = useAuth();

    if (!isLoggedIn()) {
        return (
            <Navigate to="/login" />
        );
    }

    return children;
};
