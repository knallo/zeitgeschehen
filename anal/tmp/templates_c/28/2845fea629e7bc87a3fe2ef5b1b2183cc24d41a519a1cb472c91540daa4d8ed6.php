<?php

/* @Installation/systemCheck.twig */
class __TwigTemplate_631b58db1c266b12a3b97e042b92f805a4b041dfdf595e8d57f2f277670aa8a0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Installation/layout.twig", "@Installation/systemCheck.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Installation/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "
    <script type=\"text/javascript\">
        \$(function () {
            // client-side test for https to handle the case where the server is behind a reverse proxy
            if (document.location.protocol === 'https:') {
                \$('p.next-step a').attr('href', \$('p.next-step a').attr('href') + '&clientProtocol=https');
            }
        });
    </script>

    ";
        // line 14
        if ( !(isset($context["showNextStep"]) ? $context["showNextStep"] : $this->getContext($context, "showNextStep"))) {
            // line 15
            echo "        ";
            $this->loadTemplate("@Installation/_systemCheckLegend.twig", "@Installation/systemCheck.twig", 15)->display($context);
            // line 16
            echo "        <br style=\"clear:both;\">
    ";
        }
        // line 18
        echo "
    <h2>";
        // line 19
        echo \Piwik\piwik_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_SystemCheck")), "html", null, true);
        echo "</h2>

    ";
        // line 21
        $this->loadTemplate("@Installation/_systemCheckSection.twig", "@Installation/systemCheck.twig", 21)->display($context);
        // line 22
        echo "
    ";
        // line 23
        if ( !(isset($context["showNextStep"]) ? $context["showNextStep"] : $this->getContext($context, "showNextStep"))) {
            // line 24
            echo "        <p>
            <span class=\"icon-export\"></span>
            <a href=\"?module=Proxy&action=redirect&url=http://piwik.org/docs/requirements/\" target=\"_blank\">";
            // line 26
            echo \Piwik\piwik_escape_filter($this->env, call_user_func_array($this->env->getFilter('translate')->getCallable(), array("Installation_Requirements")), "html", null, true);
            echo "</a>
        </p>
        ";
            // line 28
            $this->loadTemplate("@Installation/_systemCheckLegend.twig", "@Installation/systemCheck.twig", 28)->display($context);
            // line 29
            echo "    ";
        }
        // line 30
        echo "
";
    }

    public function getTemplateName()
    {
        return "@Installation/systemCheck.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  81 => 30,  78 => 29,  76 => 28,  71 => 26,  67 => 24,  65 => 23,  62 => 22,  60 => 21,  55 => 19,  52 => 18,  48 => 16,  45 => 15,  43 => 14,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends '@Installation/layout.twig' %}

{% block content %}

    <script type=\"text/javascript\">
        \$(function () {
            // client-side test for https to handle the case where the server is behind a reverse proxy
            if (document.location.protocol === 'https:') {
                \$('p.next-step a').attr('href', \$('p.next-step a').attr('href') + '&clientProtocol=https');
            }
        });
    </script>

    {% if not showNextStep %}
        {% include \"@Installation/_systemCheckLegend.twig\" %}
        <br style=\"clear:both;\">
    {% endif %}

    <h2>{{ 'Installation_SystemCheck'|translate }}</h2>

    {% include \"@Installation/_systemCheckSection.twig\" %}

    {% if not showNextStep %}
        <p>
            <span class=\"icon-export\"></span>
            <a href=\"?module=Proxy&action=redirect&url=http://piwik.org/docs/requirements/\" target=\"_blank\">{{ 'Installation_Requirements'|translate }}</a>
        </p>
        {% include \"@Installation/_systemCheckLegend.twig\" %}
    {% endif %}

{% endblock %}
", "@Installation/systemCheck.twig", "/home/webpages/lima-city/fruehlingsseminar/zeitgeschehen/anal/plugins/Installation/templates/systemCheck.twig");
    }
}
