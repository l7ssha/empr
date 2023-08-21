import Box from "@mui/material/Box";
import { FormContainer, SelectElement, TextFieldElement } from "react-hook-form-mui";
import { useNavigate } from "react-router-dom";
import { PaperSection } from "../../component/PaperSection";
import { SubmitButton } from "../../component/SubmitButton";
import apiService from "../../services/ApiService";
import { mapFilmType } from "../../services/ReadableStringMapper";
import { FilmTypeEnum } from "../../services/dataTypes";
import { useCustomForm } from "../../services/useCustomForm";
import { makeMaxLengthRule, makePositiveRule } from "../../services/validationHelper";
import { BasePage } from "../BasePage";

interface FormData {
  name: string;
  speed: number;
  type: FilmTypeEnum;
}

export function CreateFilmPage() {
  const navigate = useNavigate();

  const { context, submitHandler } = useCustomForm<FormData>(async (data) => {
    await apiService.createFilm(data);
    navigate("/films");
  }, {
    type: FilmTypeEnum.BlackAndWhite,
  });

  return (
    <BasePage>
      <PaperSection>
        <FormContainer<FormData> onSuccess={submitHandler} formContext={context}>
          <Box sx={{ margin: 1 }}>
            <TextFieldElement name="name" label="Name" required validation={{ ...makeMaxLengthRule(64) }} />
          </Box>
          <Box sx={{ margin: 1 }}>
            <TextFieldElement
              name="speed"
              label="Speed (ISO/ASA)"
              required
              type="number"
              validation={{ ...makePositiveRule() }}
            />
          </Box>
          <Box sx={{ margin: 1 }}>
            <SelectElement
              placeholder="Type"
              name="type"
              required
              options={[
                ...Object.values(FilmTypeEnum).map((filmType) => {
                  return { id: filmType, label: mapFilmType(filmType) };
                }),
              ]}
            ></SelectElement>
          </Box>
          <Box sx={{ margin: 1 }}>
            <SubmitButton />
          </Box>
        </FormContainer>
      </PaperSection>
    </BasePage>
  );
}
