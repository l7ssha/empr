import {FilmType} from "./ApiService";

export function mapFilmType(type: FilmType): string {
    switch (type) {
        case "bw": return 'Black and white';
        case "color_negative": return 'Color Negative';
        case "color_positive": return 'Diapositive';
    }

    throw new Error("Unknown film type");
}
