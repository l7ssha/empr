import { Container, Paper } from "@mui/material";
import { BasePage } from "./BasePage";

export const MainPage = () => {
  return (
    <BasePage>
      <Container>
        <Paper
          elevation={0}
          variant="outlined"
          square
          sx={{ marginTop: "10px", padding: "5px" }}
        >
          TEST
        </Paper>
      </Container>
    </BasePage>
  );
};
