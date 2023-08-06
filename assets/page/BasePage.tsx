import { Container } from "@mui/material";
import ResponsiveAppBar from "../component/appbar/AppBar";

export const BasePage = ({ children }) => {
  return (
    <Container>
      <ResponsiveAppBar />
      <Container>{children}</Container>
    </Container>
  );
};
