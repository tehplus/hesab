<?php
class Menu {
    private $db;
    private $menus = [];
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    public function getMenus() {
        $query = "SELECT * FROM menus WHERE is_active = 1 ORDER BY parent_id, order_num";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $this->buildTree($items);
    }
    
    private function buildTree($items, $parentId = null) {
        $branch = [];
        
        foreach ($items as $item) {
            if ($item['parent_id'] == $parentId) {
                $children = $this->buildTree($items, $item['id']);
                if ($children) {
                    $item['children'] = $children;
                }
                $branch[] = $item;
            }
        }
        
        return $branch;
    }
    
    public function isActive($url) {
        $currentPage = basename($_SERVER['PHP_SELF']);
        return (strpos($currentPage, $url) !== false) ? true : false;
    }
    
    public function hasChildren($menuItem) {
        return isset($menuItem['children']) && !empty($menuItem['children']);
    }
}
?>