export type InfoSpanType = "info" | "warning" | "danger";

export interface InfoSpanProps {
  type: InfoSpanType;
  message: string;
}

const typeToColorMap = {
  info: "blue",
  warning: "yellow",
  danger: "red",
};

export function InfoSpan({ type, message }: InfoSpanProps) {
  return <p style={{ color: typeToColorMap[type] }}>{message}</p>;
}
