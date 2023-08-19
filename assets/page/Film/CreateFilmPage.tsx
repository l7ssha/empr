import { Button } from "@mui/material";
import Box from "@mui/material/Box";
import Grid from "@mui/material/Unstable_Grid2";
import { useForm } from "react-hook-form";
import {
  FormContainer,
  SelectElement,
  TextFieldElement,
} from "react-hook-form-mui";
import { ValidationValueMessage } from "react-hook-form/dist/types/validator";
import apiService from "../../services/ApiService";
import { mapFilmType } from "../../services/ReadableStringMapper";
import { FilmTypeEnum } from "../../services/dataTypes";

function makeMaxLengthRule(maxLength: number): ValidationValueMessage<number> {
  return {
    value: maxLength,
    message: `Max length allowed: ${maxLength}`,
  };
}

export function CreateFilmPage() {
  const {
    control,
    handleSubmit,
    formState: { errors },
  } = useForm();

  const onSubmit = async (data: any) => {
    const result = await apiService.createFilm({
      ...data,
      speed: Number(data.speed),
    });
    console.log(data);
    console.log(result);
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
        <FormContainer
          onSuccess={onSubmit}
          defaultValues={{ type: FilmTypeEnum.BlackAndWhite }}
        >
          <Box sx={{ margin: 1 }}>
            <TextFieldElement
              name="name"
              label="Name"
              required
              validation={{ maxLength: makeMaxLengthRule(64) }}
            />
          </Box>
          <Box sx={{ margin: 1 }}>
            <TextFieldElement
              name="speed"
              label="Speed (ISO/ASA)"
              required
              type="number"
            />
          </Box>
          <Box sx={{ margin: 1 }}>
            <SelectElement
              placeholder="Type"
              name="type"
              defaultValue={FilmTypeEnum.BlackAndWhite}
              required
              options={[
                ...Object.values(FilmTypeEnum).map((filmType) => {
                  return { id: filmType, label: mapFilmType(filmType) };
                }),
              ]}
            ></SelectElement>
          </Box>
          <Box sx={{ margin: 1 }}>
            <Button type="submit">Log in</Button>
          </Box>
        </FormContainer>
      </Grid>
    </Grid>
  );
}
