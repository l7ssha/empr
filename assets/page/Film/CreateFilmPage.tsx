import { BasePage } from "../BasePage";
import { PaperSection } from "../../component/PaperSection";
import { SimpleDataGrid } from "../../component/SimpleDataGrid";
import apiService from "../../services/ApiService";
import { Controller, useForm } from "react-hook-form";
import Box from "@mui/material/Box";
import { Button, Input, Select } from "@mui/material";
import { InfoSpan } from "../../component/info/InfoSpan";
import SelectInput from "@mui/material/Select/SelectInput";
import { FilmType, FilmTypeEnum } from "../../services/dataTypes";
import MenuItem from "@mui/material/MenuItem";
import { mapFilmType } from "../../services/ReadableStringMapper";

export function CreateFilmPage() {
  const {
    control,
    handleSubmit,
    formState: { errors },
  } = useForm();

  const onSubmit = async (data: any) => {
    const result = await apiService.createFilm({...data, speed: Number(data.speed)});
    console.log(data);
    console.log(result);
  };

  return (
    <BasePage>
      <PaperSection>
        <form onSubmit={handleSubmit(onSubmit)}>
          <Box>
            <Controller
              name="name"
              rules={{ required: true, maxLength: 64 }}
              control={control}
              render={({ field }) => (
                <Box>
                  <Input placeholder="Name" {...field} />
                </Box>
              )}
            />
          </Box>
          <Box>
            <Controller
              name="speed"
              rules={{ required: true}}
              control={control}
              render={({ field }) => (
                <Box>
                  <Input placeholder="Speed (ISO/ASA)" {...field} type='number' />
                </Box>
              )}
            />
          </Box>
          <Box>
            <Controller
              name="type"
              rules={{ required: true }}
              control={control}
              render={({ field }) => (
                <Box>
                  <Select placeholder="Type" {...field} defaultValue={FilmTypeEnum.BlackAndWhite}>
                    {
                      Object.values(FilmTypeEnum).map((filmType) => <MenuItem key={filmType} value={filmType}>{mapFilmType(filmType)}</MenuItem>)
                    }
                  </Select>
                </Box>
              )}
            />
          </Box>
          <Box>
            <Button type="submit">Submit</Button>
          </Box>
        </form>
      </PaperSection>
    </BasePage>
  );
}
