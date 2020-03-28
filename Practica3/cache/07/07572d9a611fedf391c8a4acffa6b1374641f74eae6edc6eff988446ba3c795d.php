<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* plantillaEvento.html */
class __TwigTemplate_b40301c02d5d1d0c2c6f0a1227ab507398c23e0303cb30115fc3c201b9d20bda extends \Twig\Template
{
    private $source;

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<html>

<head>
</head>

<body>
    <h1>";
        // line 7
        echo twig_escape_filter($this->env, ($context["nombre"] ?? null), "html", null, true);
        echo "</h1>
    <h2>";
        // line 8
        echo twig_escape_filter($this->env, ($context["fecha"] ?? null), "html", null, true);
        echo "</h2>
    <img src=\"";
        // line 9
        echo twig_escape_filter($this->env, ($context["foto"] ?? null), "html", null, true);
        echo "\" />
</body>


</html>";
    }

    public function getTemplateName()
    {
        return "plantillaEvento.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 9,  47 => 8,  43 => 7,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "plantillaEvento.html", "/var/www/html/templates/plantillaEvento.html");
    }
}
