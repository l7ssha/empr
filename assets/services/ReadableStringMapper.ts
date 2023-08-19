import { DevelopmentType, FilmType } from "./dataTypes";

export function mapFilmType(type: FilmType | string): string {
  switch (type) {
    case "bw":
      return "Black and white";
    case "color_negative":
      return "Color Negative";
    case "color_positive":
      return "Diapositive";
  }

  throw new Error("Unknown film type");
}

export function mapDevelopmentType(type: DevelopmentType): string {
  switch (type) {
    case "bw_negative":
      return "Black and white Negative";
  }

  throw new Error("Unknown film type");
}
