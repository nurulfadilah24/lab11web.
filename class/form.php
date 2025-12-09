<?php

class Form
{
    private $fields = [];
    private $action;
    private $submit = "Submit";
    private $jumlahField = 0;

    public function __construct($action, $submit)
    {
        $this->action = $action;
        $this->submit = $submit;
    }

    // Tambah field form
    public function addField($name, $label, $type = "text", $options = [])
    {
        $this->fields[$this->jumlahField] = [
            'name' => $name,
            'label' => $label,
            'type' => $type,
            'options' => $options
        ];

        $this->jumlahField++;
    }

    // Tampilkan form otomatis
    public function displayForm()
    {
        echo "<form action='$this->action' method='POST'>";
        echo "<table>";

        foreach ($this->fields as $field) {
            echo "<tr>";
            echo "<td><b>{$field['label']}</b></td>";
            echo "<td>";

            switch ($field['type']) {

                case 'textarea':
                    echo "<textarea name='{$field['name']}' rows='4' cols='40'></textarea>";
                    break;

                case 'select':
                    echo "<select name='{$field['name']}'>";
                    foreach ($field['options'] as $value => $text) {
                        echo "<option value='$value'>$text</option>";
                    }
                    echo "</select>";
                    break;

                case 'radio':
                    foreach ($field['options'] as $value => $text) {
                        echo "<label><input type='radio' name='{$field['name']}' value='$value'> $text</label>";
                    }
                    break;

                case 'checkbox':
                    foreach ($field['options'] as $value => $text) {
                        echo "<label><input type='checkbox' name='{$field['name']}[]' value='$value'> $text</label>";
                    }
                    break;

                default:
                    echo "<input type='text' name='{$field['name']}'>";
            }

            echo "</td>";
            echo "</tr>";
        }

        echo "<tr><td colspan='2'><input type='submit' value='$this->submit'></td></tr>";
        echo "</table>";
        echo "</form>";
    }
}

?>