// JavaScript Document
//Login
import Login from "./Pages/login/login.vue";
//Register
import Register from "./Pages/login/register.vue";

import Dashboard from "./Pages/admin/Dashboard.vue";

import CategoryIndex from "./Pages/admin/category/index.vue";
import AddCategory from "./Pages/admin/category/add.vue";
import EditCategory from "./Pages/admin/category/edit.vue";

import PostIndex from "./Pages/admin/post/index.vue";
import AddPost from "./Pages/admin/post/add.vue";
import EditPost from "./Pages/admin/post/edit.vue";


import ShareIndex from "./Pages/admin/share/index.vue";
import AddShare from "./Pages/admin/share/add.vue";
import EditShare from "./Pages/admin/share/edit.vue";


import MemberIndex from "./Pages/admin/member/index.vue";
import AddMember from "./Pages/admin/member/add.vue";
import EditMember from "./Pages/admin/member/edit.vue";

import FriendIndex from "./Pages/admin/friend/index.vue";
import AddFriend from "./Pages/admin/friend/add.vue";
import EditFriend from "./Pages/admin/friend/edit.vue";

export const routes = [
    {
        path: "/",
        name: "Login",
        component: Login,
    },
	
	{
        path: "/register",
        name: "Register",
        component: Register,
    },
	
	{
	       path: "/Dashboard",
	       name: "Dashboard",
	       component: Dashboard,
	},

	
	//Category
	{
        path: "/category/index",
        name: "CategoryIndex",
        component: CategoryIndex,
    },
	{
        path: "/category/add",
        name: "AddCategory",
        component: AddCategory,
    },
	{
        path: "/category/edit/:id",
        name: "EditCategory",
        component: EditCategory,
    },
	//Post
	{
        path: "/post/index",
        name: "PostIndex",
        component: PostIndex,
    },
	{
        path: "/post/add",
        name: "AddPost",
        component: AddPost,
    },
	{
        path: "/post/edit/:id",
        name: "EditPost",
        component: EditPost,
    },
	
	//Share
	{
        path: "/share/index",
        name: "ShareIndex",
        component: ShareIndex,
    },
	{
        path: "/share/add",
        name: "AddShare",
        component: AddShare,
    },
	{
        path: "/share/edit/:id",
        name: "EditShare",
        component: EditShare,
    },
	
	//Member
	{
        path: "/member/index",
        name: "MemberIndex",
        component: MemberIndex,
    },
	{
        path: "/member/add",
        name: "AddMember",
        component: AddMember,
    },
	{
        path: "/member/edit/:id",
        name: "EditMember",
        component: EditMember,
    },
	
	
	//Friend
	{
        path: "/friend/index",
        name: "FriendIndex",
        component: FriendIndex,
    },
	{
        path: "/friend/add",
        name: "AddFriend",
        component: AddFriend,
    },
	{
        path: "/friend/edit/:id",
        name: "EditFriend",
        component: EditFriend,
    },
	
	
	
];