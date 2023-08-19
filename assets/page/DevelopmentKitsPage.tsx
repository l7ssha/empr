import { Button } from "@mui/material";
import {
  GridColDef,
  GridToolbarContainer,
  GridToolbarExport,
} from "@mui/x-data-grid";
import { PaperSection } from "../component/PaperSection";
import { SimpleDataGrid } from "../component/SimpleDataGrid";
import apiService from "../services/ApiService";
import { mapDevelopmentType } from "../services/ReadableStringMapper";
import { BasePage } from "./BasePage";

function GridToolbar() {
  return (
    <GridToolbarContainer>
      <GridToolbarExport />
    </GridToolbarContainer>
  );
}

export const DevelopmentKitsPage = () => {
  const columns: GridColDef[] = [
    { field: "name", headerName: "Name", width: 250 },
    {
      field: "type",
      headerName: "Type",
      width: 250,
      valueFormatter: (params) => mapDevelopmentType(params.value),
    },
    { field: "developmentsCount", headerName: "Development Count", width: 150 },
  ];

  return (
    <BasePage>
      <PaperSection>
        <Button variant="outlined">Create new kit</Button>
      </PaperSection>
      <PaperSection>
        <SimpleDataGrid
          columns={columns}
          callback={(pagination, sortModel) =>
            apiService.getAllDevelopmentKits(pagination, sortModel)
          }
        />
      </PaperSection>
    </BasePage>
  );
};
