import "./styles/app.css";

import { createRoot } from "react-dom/client";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import { ProtectedRoute } from "./component/auth/ProtectedRoute";
import { LoginPage } from "./page/LoginPage";

import "@fontsource/roboto/300.css";
import "@fontsource/roboto/400.css";
import "@fontsource/roboto/500.css";
import "@fontsource/roboto/700.css";
import { DevelopmentKitsPage } from "./page/DevelopmentKitsPage";
import { CreateFilmPage } from "./page/Film/CreateFilmPage";
import { FilmsPage } from "./page/Film/FilmsPage";
import { MainPage } from "./page/MainPage";

const App = () => {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/login" element={<LoginPage />} />

        <Route
          path="/films/create"
          element={
            <ProtectedRoute>
              <CreateFilmPage />
            </ProtectedRoute>
          }
        />
        <Route
          path="/films"
          element={
            <ProtectedRoute>
              <FilmsPage />
            </ProtectedRoute>
          }
        />
        <Route
          path="/development-kits"
          element={
            <ProtectedRoute>
              <DevelopmentKitsPage />
            </ProtectedRoute>
          }
        />

        <Route
          path="/"
          element={
            <ProtectedRoute>
              <MainPage />
            </ProtectedRoute>
          }
        />
      </Routes>
    </BrowserRouter>
  );
};

// Render your React component instead
const root = createRoot(document.getElementById("app"));
root.render(<App />);
