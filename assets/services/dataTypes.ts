export type FilmType = "bw" | "color_negative" | "color_positive";

export enum FilmTypeEnum {
  BlackAndWhite = "bw",
  ColorNegative = "color_negative",
  ColorPositive = "color_positive",
}

export type DevelopmentType =
  | "bw_negative"
  | "bw_positive"
  | "bw_one_shot"
  | "color_negative_3step"
  | "color_negative_2step"
  | "color_positive_3step"
  | "color_positive_6step";
