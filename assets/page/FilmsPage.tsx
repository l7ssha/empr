import {Container} from "@mui/material";
import {BasePage} from "./BasePage";
import apiService, {FilmResponse} from "../services/ApiService";
import {useEffect, useState} from "react";

export const FilmsPage = () => {
    const [films, setFilms] = useState<FilmResponse[]>([]);

    useEffect(() => {
        apiService.getAllFilms().then((result) => setFilms(result));
    }, []);

    return (
        <BasePage>
            <Container>
                <ol>
                    {films.map((film) => <li key={film.id}>{film.name}</li>)}
                </ol>
            </Container>
        </BasePage>
    );
}
