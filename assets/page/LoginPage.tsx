import { useAuth } from "../services/auth/useAuth";
import { Navigate, useNavigate } from "react-router-dom";
import { useForm } from "react-hook-form";

export const LoginPage = () => {
  let { isLoggedIn, login } = useAuth();
  if (isLoggedIn()) {
    return <Navigate to="/" />;
  }

  const navigate = useNavigate();

  const {
    register,
    handleSubmit,
    formState: { errors },
  } = useForm();
  const onSubmit = async (data: any) => {
    await login(data.login, data.password);
    navigate("/");
  };

  return (
    <div>
      <form onSubmit={handleSubmit(onSubmit)}>
        {/*<input {...register("email", { required: true })} /!*label="email" variant="outlined" *!//>*/}
        {/*<input {...register("password", { required: true })} /!*label="email" variant="outlined" *!/ />*/}
        <input {...register("login", { required: true })} />
        <input {...register("password", { required: true })} />
        <input type="submit" />
      </form>
    </div>
  );
};
