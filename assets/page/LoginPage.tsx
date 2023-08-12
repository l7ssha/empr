import { Button, Container, Input } from "@mui/material";
import Box from "@mui/material/Box";
import Grid from "@mui/material/Unstable_Grid2";
import { Controller, useForm } from "react-hook-form";
import { Navigate, useNavigate } from "react-router-dom";
import { InfoSpan } from "../component/info/InfoSpan";
import { useAuth } from "../services/auth/useAuth";

export const LoginPage = () => {
  let { isLoggedIn, login } = useAuth();
  if (isLoggedIn()) {
    return <Navigate to="/" />;
  }

  const navigate = useNavigate();

  const {
    control,
    handleSubmit,
    formState: { errors },
  } = useForm();
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
        <Container>
          <form onSubmit={handleSubmit(onSubmit)}>
            <Box>
              <Controller
                name="login"
                rules={{ required: true }}
                control={control}
                render={({ field }) => (
                  <Box>
                    <Input placeholder="Username" {...field} />
                    {errors.login?.type === "required" && (
                      <InfoSpan type="danger" message="Login is required!" />
                    )}
                  </Box>
                )}
              />
            </Box>
            <Box>
              <Controller
                name="password"
                rules={{ required: true }}
                control={control}
                render={({ field }) => (
                  <Box>
                    <Input placeholder="Password" type="password" {...field} />
                    {errors.password?.type === "required" && (
                      <InfoSpan type="danger" message="Password is required!" />
                    )}
                  </Box>
                )}
              />
            </Box>
            <Box>
              <Button type="submit">Log in</Button>
            </Box>
          </form>
        </Container>
      </Grid>
    </Grid>
  );
};
