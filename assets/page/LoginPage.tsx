import { Button } from "@mui/material";
import Box from "@mui/material/Box";
import Grid from "@mui/material/Unstable_Grid2";
import { FormContainer, TextFieldElement } from "react-hook-form-mui";
import { Navigate, useNavigate } from "react-router-dom";
import { useAuth } from "../services/auth/useAuth";

export const LoginPage = () => {
  let { isLoggedIn, login } = useAuth();
  if (isLoggedIn()) {
    return <Navigate to="/" />;
  }

  const navigate = useNavigate();
  const onSubmit = async (data: any) => {
    await login(data.login, data.password);
    navigate("/");
  };

  return (
    <Grid
      container
      spacing={2}
      justifyContent="center"
      alignItems="center"
      direction="column"
    >
      <Grid display="flex">
        <h1>EMPR</h1>
      </Grid>
      <Grid display="flex">
        <FormContainer defaultValues={{ login: "" }} onSuccess={onSubmit}>
          <Box sx={{ margin: 1 }}>
            <TextFieldElement name="login" label="Username" required />
          </Box>
          <Box sx={{ margin: 1 }}>
            <TextFieldElement
              name="password"
              label="Password"
              required
              type="password"
            />
          </Box>
          <Box sx={{ margin: 1 }}>
            <Button type="submit">Log in</Button>
          </Box>
        </FormContainer>
      </Grid>
    </Grid>
  );
};
