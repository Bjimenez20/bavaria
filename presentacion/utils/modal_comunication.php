<div class="modal fade" id="comunicationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Comunicaciones</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body overflow-auto">
                <?php
                $gestion = mysqli_query($conex, "SELECT * FROM `ipsen_gestiones_aspirante` WHERE `ID_ASPIRANTE_FK2` = '" . $ID_ASPIRANTE2 . "' ORDER BY `FECHA_COMUNICACION` DESC");
                echo mysqli_error($conex);
                echo "<table width=100% border=1 rules=all  align=left class=Estilo2 >";
                echo "<tr style='border:1px solid #fff'>";
                echo "<th class=AccordionPanelTab><strong>FECHA DE GESTION</strong></th>";
                echo "<th class=AccordionPanelTab><strong>DESCRIPCION</strong></th>";
                echo "<th class=AccordionPanelTab><strong>FECHA PROXIMO CONTACTO</strong></th>";
                echo "<th class=AccordionPanelTab><strong>AUTOR</strong></th>";
                echo "<th class=AccordionPanelTab><strong>MOTIVO COMUNICACION GESTION</strong></th>";
                echo "</tr>";
                $numges = 1;
                while ($fila2 = mysqli_fetch_array($gestion)) {
                    echo "<tr style='border:1px solid gray'>";
                    echo "<td style='border:1px solid gray'>" . $fila2['FECHA_COMUNICACION'] . "</td>";
                    echo "<td style='border:1px solid gray'>";
                ?>
                    <textarea name="observaciones" cols="60" rows="2" readonly="readonly" id="observaciones" class="letra" style="text-transform:uppercase"><?php echo $fila2['DESCRIPCION_COMUNICACION_GESTION']; ?></textarea>
                <?php
                    echo "</td>";
                    echo "<td style='border:1px solid gray'>" . $fila2['FECHA_PROGRAMADA_GESTION'] . "</td>";
                    echo "<td style='border:1px solid gray'>" . $fila2['AUTOR_GESTION'] . "</td>";
                    echo "<td style='border:1px solid gray'>" . $fila2['MOTIVO_COMUNICACION_GESTION'] . "</td>";
                    echo "</tr>";
                    $numges = $numges + 1;
                }
                echo "</table>";
                echo "<br>";
                ?>
            </div>
        </div>
    </div>
</div>