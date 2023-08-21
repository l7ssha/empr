import { Paper } from "@mui/material";
import { PropsWithChildren } from "react";

export function PaperSection({ children }: PropsWithChildren) {
  return (
    <Paper elevation={0} variant="outlined" square sx={{ marginTop: "10px", padding: "5px" }}>
      {children}
    </Paper>
  );
}
