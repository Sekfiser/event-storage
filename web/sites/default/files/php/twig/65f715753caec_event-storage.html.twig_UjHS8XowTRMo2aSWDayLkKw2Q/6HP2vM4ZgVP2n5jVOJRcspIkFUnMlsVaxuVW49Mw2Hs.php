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

/* modules/custom/event_storage/templates/event-storage.html.twig */
class __TwigTemplate_560c5ba44621fd2d9f181016c440c68e extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!-- Let's output the three variables passed to this template -->
<div class=\"container\">
  <div class=\"filter-wrapper\">
    ";
        // line 4
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["searchForm"] ?? null), 4, $this->source), "html", null, true);
        echo "
  </div>
  <div class=\"creation-panel\">
    <a class=\"button--primary button\" href=\"/event-storage/event\">Создать событие</a>
  </div>
    ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["events"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 10
            echo "      <div class=\"event-container text-content\">
        <div class=\"event-header\">
          <div class=\"event-type\">
            <span>";
            // line 13
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "event_type_translation", [], "any", false, false, true, 13), 13, $this->source), "html", null, true);
            echo "</span>
            <a href=\"";
            // line 14
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("event_storage.event_delete", twig_array_merge($this->sandbox->ensureToStringAllowed(($context["currentFilters"] ?? null), 14, $this->source), ["eventId" => twig_get_attribute($this->env, $this->source, $context["item"], "event_id", [], "any", false, false, true, 14), "page" => ($context["currentPage"] ?? null)])), "html", null, true);
            echo "\">Удалить</a>
          </div>
          <div class=\"event-title\">
            <span>";
            // line 17
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "event_title", [], "any", false, false, true, 17), 17, $this->source), "html", null, true);
            echo "</span>
          </div>
        </div>
        <div class=\"event-description\">
            ";
            // line 21
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "event_description", [], "any", false, false, true, 21), 21, $this->source));
            echo "
        </div>
        ";
            // line 23
            if (twig_get_attribute($this->env, $this->source, $context["item"], "tags", [], "any", false, false, true, 23)) {
                // line 24
                echo "        <div class=\"event-tags\">
          <div>Тэги:</div>
          ";
                // line 26
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "tags", [], "any", false, false, true, 26));
                foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                    // line 27
                    echo "            <div class=\"event-tag\">";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["tag"], "tag_name", [], "any", false, false, true, 27), 27, $this->source), "html", null, true);
                    echo "</div>
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 29
                echo "        </div>
        ";
            }
            // line 31
            echo "        <div class=\"event-footer\">
          <span>Дата и время создания: ";
            // line 32
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, twig_date_format_filter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["item"], "event_created_at", [], "any", false, false, true, 32), 32, $this->source), "H:i d.m.Y"), "html", null, true);
            echo "</span>
          <a href=\"";
            // line 33
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath("event_storage.event_edit", ["eventId" => twig_get_attribute($this->env, $this->source, $context["item"], "event_id", [], "any", false, false, true, 33)]), "html", null, true);
            echo "\">Редактировать</a>
        </div>
      </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 37
        echo "  ";
        ob_start(function () { return ''; });
        // line 38
        echo "    ";
        if ((($context["lastPage"] ?? null) > 1)) {
            // line 39
            echo "
      ";
            // line 41
            echo "      ";
            $context["extremePagesLimit"] = 3;
            // line 42
            echo "
      ";
            // line 44
            echo "      ";
            $context["nearbyPagesLimit"] = 1;
            // line 45
            echo "
      ";
            // line 46
            if ( !array_key_exists("currentFilters", $context)) {
                $context["currentFilters"] = twig_array_merge($this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, true, 46), "attributes", [], "any", false, false, true, 46), "get", ["_route_params"], "method", false, false, true, 46), 46, $this->source), $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, true, 46), "query", [], "any", false, false, true, 46), "all", [], "any", false, false, true, 46), 46, $this->source));
            }
            // line 47
            echo "      ";
            if ( !array_key_exists("paginationPath", $context)) {
                $context["paginationPath"] = twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["app"] ?? null), "request", [], "any", false, false, true, 47), "attributes", [], "any", false, false, true, 47), "get", ["_route"], "method", false, false, true, 47);
            }
            // line 48
            echo "      ";
            if ( !array_key_exists("showAlwaysFirstAndLast", $context)) {
                $context["showAlwaysFirstAndLast"] = true;
            }
            // line 49
            echo "
      <nav aria-label=\"Page navigation\" class=\"pagination-wrapper\">
        <ul class=\"pagination\">
          ";
            // line 52
            if ((($context["currentPage"] ?? null) > 1)) {
                // line 53
                echo "            <li class=\"page-item\"><a class=\"page-link\"
                                     href=\"";
                // line 54
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath($this->sandbox->ensureToStringAllowed(($context["paginationPath"] ?? null), 54, $this->source), twig_array_merge($this->sandbox->ensureToStringAllowed(($context["currentFilters"] ?? null), 54, $this->source), ["page" => (($context["currentPage"] ?? null) - 1)])), "html", null, true);
                echo "\"><</a>
            </li>

            ";
                // line 57
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_array_filter($this->env, range(1, ($context["extremePagesLimit"] ?? null)), function ($__i__) use ($context, $macros) { $context["i"] = $__i__; return ($context["i"] < (($context["currentPage"] ?? null) - ($context["nearbyPagesLimit"] ?? null))); }));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 58
                    echo "              <li class=\"page-item\"><a class=\"page-link\"
                                       href=\"";
                    // line 59
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath($this->sandbox->ensureToStringAllowed(($context["paginationPath"] ?? null), 59, $this->source), twig_array_merge($this->sandbox->ensureToStringAllowed(($context["currentFilters"] ?? null), 59, $this->source), ["page" => $context["i"]])), "html", null, true);
                    echo "\">";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 59, $this->source), "html", null, true);
                    echo "</a>
              </li>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 62
                echo "
            ";
                // line 63
                if (((($context["extremePagesLimit"] ?? null) + 1) < (($context["currentPage"] ?? null) - ($context["nearbyPagesLimit"] ?? null)))) {
                    // line 64
                    echo "              <li class=\"page-dots\">
                <span class=\"sep-dots\">...</span>
              </li>
            ";
                }
                // line 68
                echo "
            ";
                // line 69
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_array_filter($this->env, range((($context["currentPage"] ?? null) - ($context["nearbyPagesLimit"] ?? null)), (($context["currentPage"] ?? null) - 1)), function ($__i__) use ($context, $macros) { $context["i"] = $__i__; return ($context["i"] > 0); }));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 70
                    echo "              <li class=\"page-item\"><a class=\"page-link\"
                                       href=\"";
                    // line 71
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath($this->sandbox->ensureToStringAllowed(($context["paginationPath"] ?? null), 71, $this->source), twig_array_merge($this->sandbox->ensureToStringAllowed(($context["currentFilters"] ?? null), 71, $this->source), ["page" => $context["i"]])), "html", null, true);
                    echo "\">";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 71, $this->source), "html", null, true);
                    echo "</a>
              </li>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 74
                echo "          ";
            } elseif (($context["showAlwaysFirstAndLast"] ?? null)) {
                // line 75
                echo "            <li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\"><</a></li>
          ";
            }
            // line 77
            echo "
          <li class=\"page-item active\"><a class=\"page-link\"
                                          href=\"";
            // line 79
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath($this->sandbox->ensureToStringAllowed(($context["paginationPath"] ?? null), 79, $this->source), twig_array_merge($this->sandbox->ensureToStringAllowed(($context["currentFilters"] ?? null), 79, $this->source), ["page" => ($context["currentPage"] ?? null)])), "html", null, true);
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["currentPage"] ?? null), 79, $this->source), "html", null, true);
            echo "</a>
          </li>

          ";
            // line 82
            if ((($context["currentPage"] ?? null) < ($context["lastPage"] ?? null))) {
                // line 83
                echo "            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_array_filter($this->env, range((($context["currentPage"] ?? null) + 1), (($context["currentPage"] ?? null) + ($context["nearbyPagesLimit"] ?? null))), function ($__i__) use ($context, $macros) { $context["i"] = $__i__; return ($context["i"] <= ($context["lastPage"] ?? null)); }));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 84
                    echo "              <li class=\"page-item\"><a class=\"page-link\"
                                       href=\"";
                    // line 85
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath($this->sandbox->ensureToStringAllowed(($context["paginationPath"] ?? null), 85, $this->source), twig_array_merge($this->sandbox->ensureToStringAllowed(($context["currentFilters"] ?? null), 85, $this->source), ["page" => $context["i"]])), "html", null, true);
                    echo "\">";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 85, $this->source), "html", null, true);
                    echo "</a>
              </li>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 88
                echo "
            ";
                // line 89
                if (((($context["lastPage"] ?? null) - ($context["extremePagesLimit"] ?? null)) > (($context["currentPage"] ?? null) + ($context["nearbyPagesLimit"] ?? null)))) {
                    // line 90
                    echo "              <li class=\"page-dots\">
                <span class=\"sep-dots\">...</span>
              </li>
            ";
                }
                // line 94
                echo "
            ";
                // line 95
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_array_filter($this->env, range(((($context["lastPage"] ?? null) - ($context["extremePagesLimit"] ?? null)) + 1), ($context["lastPage"] ?? null)), function ($__i__) use ($context, $macros) { $context["i"] = $__i__; return ($context["i"] > (($context["currentPage"] ?? null) + ($context["nearbyPagesLimit"] ?? null))); }));
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 96
                    echo "              <li class=\"page-item\"><a class=\"page-link\"
                                       href=\"";
                    // line 97
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath($this->sandbox->ensureToStringAllowed(($context["paginationPath"] ?? null), 97, $this->source), twig_array_merge($this->sandbox->ensureToStringAllowed(($context["currentFilters"] ?? null), 97, $this->source), ["page" => $context["i"]])), "html", null, true);
                    echo "\">";
                    echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["i"], 97, $this->source), "html", null, true);
                    echo "</a>
              </li>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 100
                echo "
            <li class=\"page-item\"><a class=\"page-link\"
                                     href=\"";
                // line 102
                echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getPath($this->sandbox->ensureToStringAllowed(($context["paginationPath"] ?? null), 102, $this->source), twig_array_merge($this->sandbox->ensureToStringAllowed(($context["currentFilters"] ?? null), 102, $this->source), ["page" => (($context["currentPage"] ?? null) + 1)])), "html", null, true);
                echo "\">></a>
            </li>
          ";
            } elseif (            // line 104
($context["showAlwaysFirstAndLast"] ?? null)) {
                // line 105
                echo "            <li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">></a></li>
          ";
            }
            // line 107
            echo "        </ul>
      </nav>
    ";
        }
        // line 110
        echo "  ";
        $___internal_parse_0_ = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 37
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(twig_spaceless($___internal_parse_0_));
        // line 111
        echo "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["searchForm", "events", "currentFilters", "currentPage", "lastPage", "app", "paginationPath", "showAlwaysFirstAndLast"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "modules/custom/event_storage/templates/event-storage.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  321 => 111,  319 => 37,  316 => 110,  311 => 107,  307 => 105,  305 => 104,  300 => 102,  296 => 100,  285 => 97,  282 => 96,  278 => 95,  275 => 94,  269 => 90,  267 => 89,  264 => 88,  253 => 85,  250 => 84,  245 => 83,  243 => 82,  235 => 79,  231 => 77,  227 => 75,  224 => 74,  213 => 71,  210 => 70,  206 => 69,  203 => 68,  197 => 64,  195 => 63,  192 => 62,  181 => 59,  178 => 58,  174 => 57,  168 => 54,  165 => 53,  163 => 52,  158 => 49,  153 => 48,  148 => 47,  144 => 46,  141 => 45,  138 => 44,  135 => 42,  132 => 41,  129 => 39,  126 => 38,  123 => 37,  113 => 33,  109 => 32,  106 => 31,  102 => 29,  93 => 27,  89 => 26,  85 => 24,  83 => 23,  78 => 21,  71 => 17,  65 => 14,  61 => 13,  56 => 10,  52 => 9,  44 => 4,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/event_storage/templates/event-storage.html.twig", "/var/www/kvaiser/web/modules/custom/event_storage/templates/event-storage.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 9, "if" => 23, "apply" => 37, "set" => 41);
        static $filters = array("escape" => 4, "merge" => 14, "raw" => 21, "date" => 32, "filter" => 57, "spaceless" => 37);
        static $functions = array("path" => 14, "range" => 57);

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if', 'apply', 'set'],
                ['escape', 'merge', 'raw', 'date', 'filter', 'spaceless'],
                ['path', 'range']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
