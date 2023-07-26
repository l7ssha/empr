import {Paper, Table, TableBody, TableCell, TableContainer, TableHead, TableRow} from "@mui/material";
import {BasePage} from "./BasePage";
import apiService, {FilmResponse} from "../services/ApiService";
import {useEffect, useState} from "react";
import {mapFilmType} from "../services/ReadableStringMapper";

export const FilmsPage = () => {
    const [films, setFilms] = useState<FilmResponse[]>([]);

    useEffect(() => {
        apiService.getAllFilms().then((result) => setFilms(result));
    }, []);

    return (
        <BasePage>
            <Paper elevation={0} variant="outlined" square sx={{marginTop: '10px', padding: '5px'}}>
                <TableContainer component={Paper}>
                    <Table sx={{ minWidth: 650 }} aria-label="simple table">
                        <TableHead>
                            <TableRow>
                                <TableCell align="left">Name</TableCell>
                                <TableCell align="left">Type</TableCell>
                                <TableCell align="left">Speed (ISO/ASA)</TableCell>
                            </TableRow>
                        </TableHead>
                        <TableBody>
                            {films.map((row) => (
                                <TableRow
                                    key={row.id}
                                    sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
                                >
                                    <TableCell align="left">{row.name}</TableCell>
                                    <TableCell align="left">{mapFilmType(row.type)}</TableCell>
                                    <TableCell align="left">{row.speed}</TableCell>
                                </TableRow>
                            ))}
                        </TableBody>
                    </Table>
                </TableContainer>
            </Paper>
        </BasePage>
    );
}
